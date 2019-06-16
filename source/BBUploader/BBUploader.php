<?php
    namespace Source\BBUploader;

    class BBUploader{

        private $path;
        private $dbPath;
       

        function __construct($path)
        {
            $this->path = $path;
            $pathArr = explode("/", $this->path);
            $this->dbPath = end($pathArr);
            $this->checkFolder();
        }

        public function doUpload($getPost)
        {
            if($_FILES && !empty($_FILES['file']['name'])){
                $fileUpload = $_FILES['file'];

                $alowedTypes = [
                    "image/jpg",
                    "image/jpeg",
                    "image/png",
                    "application/pdf"
                ];

                $newFileName = time() . mb_strstr($fileUpload['name'], ".");
                if(in_array($fileUpload['type'], $alowedTypes)){
                     if(move_uploaded_file($fileUpload['tmp_name'], $this->path . "/{$newFileName}")){
                        return $this->dbPath . "/{$newFileName}";
                     }else{
                        throw new \Exception("Erro Inesperado, por favor tente mais tarde!"); 
                     }  
                }else{
                    throw new \Exception("Tipo de arquivo não permitido!"); 
                }


            }else if($getPost){ //provalvemnrto estou o limite
                throw new \Exception("Imagem maior que o limite permitido!"); 
            }else{
                if($_FILES){ //n selecionou uma imagem
                    throw new \Exception("Imagem não selecionada, por favor insira uma para continuar!");
                }
            }
        }

        private function checkFolder()
        {
           
            if(!file_exists($this->path) || !is_dir($this->path)){
                mkdir($this->path, 0755);
            }
        }


    }