<?php
class UploadExample
{
    protected $dest;
    public function __construct($dest)
    {
        $this->dest = rtrim($dest, '/') . '/';
    }
    public function handle($name)
    {
        if (is_uploaded_file($_FILES[$name]['tmp_name'])) {
            move_uploaded_file(
                $_FILES[$name]['tmp_name'],
                $this->dest . $_FILES[$name]['name']
            );
        }
    }
}
