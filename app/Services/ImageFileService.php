<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;
class ImageFileService
{
    protected $file;
    protected $mime_type;
    protected $extension;
    protected $file_name;
    protected $filesystem;
    /**
     * @param [file] $file       the file we want to save
     * @param [string] $file_name  the file name
     * @param [string] $filesystem the filesystem where we want to save
     */
    public function __construct($file, $file_name, $filesystem)
    {
        $this->file = $file;
        $this->file_name = $file_name;
        $this->filesystem = $filesystem;
    }
    /**
     * save the base64 file
     */
    public function save()
    {
        try {
            $this->create_mime_type();

            $this->get_extension_from_mime_type();
            $this->convert_from_base64();

            $this->create_file_name();
            $this->store_file();
        } catch (\Exception $e) {
            \Log::info('File upload failed: ' . $e->getMessage());
            return response()->error('File upload failed');
        }
    }
    /**
     * get the mimetype of the file
     */
    protected function create_mime_type()
    {
        $pos  = strpos($this->file, ';');
        $this->mime_type = explode(':', substr($this->file, 0, $pos))[1];
    }
    /**
     * get the extension from the mimetype
     */
    protected function get_extension_from_mime_type()
    {
        $extension = explode('/', $this->mime_type);
        $this->extension = $extension[1];
    }
    /**
     * create the filename with extension attached
     */
    protected function create_file_name()
    {
        $this->file_name = uniqid(str_slug($this->file_name)) . '.' . $this->extension;
    }
    /**
     * convert from base 64 to a file
     */
    protected function convert_from_base64()
    {
        $this->file = str_replace('data:' . $this->mime_type .';base64,', '', $this->file);
        $this->file = str_replace(' ', '+', $this->file);
        $this->file = base64_decode($this->file);
    }
    /**
     * store the file to the disk
     */
    protected function store_file()
    {
        try {
            Storage::disk($this->filesystem)->put($this->file_name, $this->file);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function get_file_name()
    {
        return $this->file_name;
    }
    public function get_mime_type()
    {
        return $this->mime_type;
    }
}
