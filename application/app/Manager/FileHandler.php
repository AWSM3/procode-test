<?php
/**
 * @filename: FileHandler.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Manager;

/** @uses */
use App\Core\Database\AdapterInterface;
use App\Core\Storage\StorageInterface;
use App\Core\Storage\StoredFile;
use App\Entity\File;
use App\Entity\Mappers\FileMapper;
use App\Entity\Mappers\FilePageMapper;
use App\Manager\Converter\ConvertedFile;
use App\Repository\Interfaces\FilePageRepositoryInterface;
use App\Repository\Interfaces\FileRepositoryInterface;
use Slim\Http\UploadedFile;

/**
 * Class FileHandler
 * @package App\Manager
 */
class FileHandler
{
    /** @var Converter\ConverterInterface */
    private $converter;
    /** @var StorageInterface */
    private $storage;
    /** @var FileRepositoryInterface */
    private $fileRepository;
    /** @var FilePageRepositoryInterface */
    private $filePageRepository;
    /** @var FileMapper */
    private $fileMapper;
    /** @var FilePageMapper */
    private $filePageMapper;
    /** @var AdapterInterface */
    private $adapter;

    /**
     * FileHandler constructor.
     *
     * @param Converter\ConverterInterface $converter
     * @param StorageInterface             $storage
     * @param FileRepositoryInterface      $fileRepository
     * @param FilePageRepositoryInterface  $filePageRepository
     * @param FileMapper                   $fileMapper
     * @param FilePageMapper               $filePageMapper
     * @param AdapterInterface             $adapter
     */
    public function __construct(Converter\ConverterInterface $converter, StorageInterface $storage,
                                FileRepositoryInterface $fileRepository,
                                FilePageRepositoryInterface $filePageRepository,
                                FileMapper $fileMapper, FilePageMapper $filePageMapper, AdapterInterface $adapter)
    {
        $this->converter = $converter;
        $this->storage = $storage;
        $this->fileRepository = $fileRepository;
        $this->filePageRepository = $filePageRepository;
        $this->fileMapper = $fileMapper;
        $this->filePageMapper = $filePageMapper;
        $this->adapter = $adapter;
    }

    /**
     * @param UploadedFile $uploadedFile
     *
     * @return void
     * @throws \Exception
     */
    public function convertFile(UploadedFile $uploadedFile): void
    {
        if (!$this->converter->validateFile($uploadedFile->file)) {
            throw new \RuntimeException('Invalid file type');
        }

        $file = $this->storage->moveUploadedFile($uploadedFile);
        try {
            /** @var File $fileEntity */
            $fileEntity = $this->fileRepository->get($file->getHash(), 'hash');

            $e = new Exception\FileAlreadyProcessedException;
            $e->setFileEntity($fileEntity);
            throw $e;
        } catch (Exception\FileAlreadyProcessedException $e) {
            throw $e;
        } catch (\Exception $e) {}

        /** @todo Конвертацию можно бросать в очередь, тот же beanstalkd */
        $converted = $this->converter->convert($file->getLocal());

        /** Сохраняем в БД */
        $this->persistConverted($converted, $file);
    }

    /**
     * @param ConvertedFile $converted
     * @param StoredFile    $storedFile
     *
     * @return void
     * @throws \Exception
     */
    protected function persistConverted(ConvertedFile $converted, StoredFile $storedFile): void
    {
        $fileEntity = $this->fileMapper->hydrate(
            [
                'hash'        => $storedFile->getHash(),
                'stored_file' => $storedFile,
            ]
        );

        $pages = [];
        foreach ($converted->getPages() as $page => $content) {
            $pages[] = $this->filePageMapper->hydrate(
                [
                    'file'    => $fileEntity,
                    'page'    => $page,
                    'content' => $content,
                ]);
        }

        $this->adapter->beginTransaction();
        try {
            $this->fileRepository->create($fileEntity);
            $this->filePageRepository->createMany(...$pages);
        } catch (\Exception $e) {
            $this->adapter->rollbackTransaction();
            throw $e;
        }
        $this->adapter->commitTransaction();
    }
}