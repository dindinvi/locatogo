<?php

namespace djepo\LocationBundle\Entity;

use djepo\MainBundle\Utils\OutilsImage as OutilsImage;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * image
 *
 * @ORM\Table(name="loca_image")
 * @ORM\Entity(repositoryClass="djepo\LocationBundle\Entity\imageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
     /**
      
     */
    /**
     * @Assert\Image(
     *     minWidth = 200,
     *     minWidthMessage="Largeur de fichier trop faible({{ width }}px). Largeur minimun acceptée: {{ minWidth }}px",     
     *     minHeight = 200,
     *     minHeightMessage="hauteur de fichier trop faible({{ heigh }}px). hauteur minimun acceptée: {{ minHeight }}px",   
     *     maxSize = "1024k",
     *     maxSizeMessage ="Taille de fichier trop important({{size}}px). taille maximun acceptée: {{ maxSize}}px",
     *     mimeTypes = {"image/jpg", "image/jpeg","image/png"},
     *     mimeTypesMessage = "Choisissez un fichier image valide. Extensions acceptees : .jpg , .jpeg , .png "
     * )
     */
   private $file1;     
    private $tempFilename1;
    /**
     * @Assert\Image(
      *     minWidth = 200,
     *     minWidthMessage="Largeur de fichier trop faible( {{ width }} px). Largeur minimun acceptée: {{ minWidth }}px",      
     *     minHeight = 200,
     *     minHeightMessage="hauteur de fichier trop faible( {{ heigh }} px). hauteur minimun acceptée: {{ minHeight }}px",   
     *     maxSize = "1024k",
     *     maxSizeMessage ="Taille de fichier trop important ( {{size}} px). taille maximun acceptée: {{ maxSize}}px",
     *     mimeTypes = {"image/jpg", "image/jpeg","image/png"},
     *     mimeTypesMessage = "Choisissez un fichier image valide. Extensions acceptees : .jpg , .jpeg , .png "
     * )
     */
    private $file2;     
    private $tempFilename2;
    /**
     * @Assert\Image(
     *     minWidth = 200,
     *     minWidthMessage="Largeur de fichier trop faible({{ width }}px). Largeur minimun acceptée: {{ minWidth }}px",     *     
     *     minHeight = 200,
     *     minHeightMessage="hauteur de fichier trop faible({{ heigh }}px). hauteur minimun acceptée: {{ minHeight }}px",   
     *     maxSize = "1024k",
     *     maxSizeMessage ="Taille de fichier trop important({{size}}px). taille maximun acceptée: {{ maxSize}}px",
     *     mimeTypes = {"image/jpg", "image/jpeg","image/png"},
     *     mimeTypesMessage = "Choisissez un fichier image valide. Extensions acceptees : .jpg , .jpeg , .png "
     * )
     */
     
    private $file3;    
    private $tempFilename3;
    /**
     * @var string
     * 
     * @ORM\Column(name="url", type="string", length=255)
     * 
     */
    private $url;

    /**
     * @var string
     * 
     * @ORM\Column(name="alt", type="string", length=255, nullable=false)
     */
    private $alt;

    /**
     * @var string 
     * @ORM\Column(name="url2", type="string", length=255, nullable=true)
     */
    private $url2;

    /**
     * @var string 
     * @ORM\Column(name="alt2", type="string", length=255, nullable=true)
     */
    private $alt2;
    /**
     * @var string 
     * @ORM\Column(name="url3", type="string", length=255, nullable=true)
     */
    private $url3;

    /**
     * @var string 
     * @ORM\Column(name="alt3", type="string", length=255, nullable=true)
     */
    private $alt3;
    /**
     * @var string
     * @ORM\Column(name="pictoUrl", type="string", length=255, nullable=true)
     */
    private $pictoUrl;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()  { return $this->id; }

    /**
     * Set url
     *
     * @param string $url
     * @return image
     */
    public function setUrl($url)
            
    {
        if (($url !== $this->url) && ($this->url !== null) ) {  // On vérifie si on avait déjà un fichier pour cette entité

                $this->tempFilename1 = $this->url;  // On sauvegarde  LE nom du fichier pour le supprimer     plus tard
            }
        $this->url = $url;
       return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url2
     *
     * @param string $url2
     * @return image
     */
    public function setUrl2($url)
    {
        if (($url !== $this->url2) && ($this->url2 !== null) ) { $this->tempFilename2 = $this->url2;} 
           
        $this->url2 = $url;

        return $this;
    }

    /**
     * Get url2
     *
     * @return string 
     */
    public function getUrl2()
    {
        return $this->url2;
    }
    
     /**
     * Set url3
     *
     * @param string $url3
     * @return image
     */
    public function setUrl3($url)
    {
        if (($url !== $this->url3) && ($this->url3 !== null) ) { $this->tempFilename3 = $this->url3; } 
        $this->url3 = $url;

        return $this;
    }

    /**
     * Get url3
     *
     * @return string 
     */
    public function getUrl3()
    {
        return $this->url3;
    }
    
     
    
    /**
     * Set alt
     *
     * @param string $alt
     * @return image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    
    
    /**
     * Set alt2
     *
     * @param string $alt2
     * @return image
     */
    public function setAlt2($alt = null)
    {
        $this->alt2 = $alt;

        return $this;
    }

    /**
     * Get alt2
     *
     * @return string 
     */
    public function getAlt2() {
        return $this->alt2;
    }
    
    
    /**
     * Set alt3
     *
     * @param string $alt3
     * @return image
     */
    public function setAlt3($alt = null)
    {
        $this->alt3 = $alt;

        return $this;
    }

    /**
     * Get alt3
     *
     * @return string 
     */
    public function getAlt3()
    {
        return $this->alt3;
    }
    
    
    public function setFile1(UploadedFile $file)
    {
        $this->file1 = $file;
     }
    
    
     public function setFile2(UploadedFile $file = null)
    {
        $this->file2 = $file;
       
    }
   
    public function setFile3(UploadedFile $file = null)
    {
        $this->file3 = $file;
       
    }
    public function getFile1( )
    {
         return  $this->file1;
     }
    
    
     public function getFile2( )
    {
         return  $this->file2 ;
       
    }
   
    public function getFile3()
    {
        return $this->file3 ;
       
    }
    /**
* @ORM\PrePersist()
* @ORM\PreUpdate()
*/
    public function preUpload()
    {
    // Si jamais il n'y a pas de fichier (champ facultatif)
    // $outils = $this->container->get('djepo_main.outils');  $this->id.'_'.

     if (null !== $this->file1) { $this->url = str_replace(' ', '_', $this->getUrl().".".$this->file1->guessExtension()); }
     if (null !== $this->file2) { $this->url2 = str_replace(' ', '_', $this->getUrl2().".".$this->file2->guessExtension()); }
     if (null !== $this->file3) { $this->url3 = str_replace(' ', '_', $this->getUrl3().".".$this->file3->guessExtension()); }
  }
  
   function traiterUpload($file, $tempFilename, $url ){
       
     if (null === $file) { return; } // Si on avait un ancien fichier, on le supprime
        if (null !==  $tempFilename) {
               $oldFile = $this->getUploadRootDir().$this->id.'_'.$tempFilename;
                if (file_exists($oldFile)) { unlink($oldFile); }
        }
             // On déplace le fichier envoyé dans le répertoire de notre choix  
             $file->move(
              $this->getUploadRootDir(), // Le répertoire de destination
               $url // Le nom du fichier à créer, ici« id.extension »
             );
            // --------------------
	// REDIMENSIONNEMENT et SAUVEGARDE de la PHOTO (si necessaire)
         // $outilsImg = $this->container->get('djepo_main.outilsImage');
           $redimPHOTOOK = OutilsImage::fctredimimage(
                             150,                           //pictos
                             150,                         // 
                              $this->getResizeDir(),
                              '',
                             $this->getUploadRootDir(),
                             $url); 
             
             $redimPHOT = OutilsImage::fctredimimage(
                             450,                           //Resize
                             300,                         // 
                             $this->getUploadLocationDir(),
                              '',
                             $this->getUploadRootDir(),
                             $url); 
                   
                     
          unset($file);
               
  }
  
 
          /**
        * @ORM\PostPersist()
        * @ORM\PostUpdate()
        */
        public function upload()
        {
            $this->traiterUpload($this->file1, $this->tempFilename1,  $this->id.'_'.$this->url );
            $this->traiterUpload($this->file2, $this->tempFilename2,  $this->id.'_'.$this->url2 );
            $this->traiterUpload($this->file3, $this->tempFilename3,  $this->id.'_'.$this->url3 );
             
        }
        
           /**
            * @ORM\PreRemove()
            */
            public function preRemoveUpload1() { $this->traiterPreRemoveU($this->tempFilename1,  $this->id.'_'.$this->url );  }
            
            /**
            * @ORM\PostRemove()
            */
            public function removeUpload1() { $this->traiterPostRemoveU($this->tempFilename1); }
            
           /**
            * @ORM\PreRemove()
            */
            public function preRemoveUpload2() { $this->traiterPreRemoveU($this->tempFilename2,  $this->id.'_'.$this->url2 );  }
            
            /**
            * @ORM\PostRemove()
            */
            public function removeUpload2() { $this->traiterPostRemoveU($this->tempFilename2); }
            
            /**
            * @ORM\PreRemove()
            */
            public function preRemoveUpload3() { $this->traiterPreRemoveU($this->tempFilename3,  $this->id.'_'.$this->url3 );  }
            
            /**
            * @ORM\PostRemove()
            */
            public function removeUpload3() { $this->traiterPostRemoveU($this->tempFilename3); }
            
             public function getResizeDir(){
                // On retourne le chemin relatif vers l'image pour un navigateur media/cache/cga/
                    return 'media/images/pictos/';// EN FAIRE UNE CONSTANTE 
                    
            }
            
            public function getUploadDir(){
                // On retourne le chemin relatif vers l'image pour un navigateur media/cache/cga/
                    return 'media/images/upload/';// EN FAIRE UNE CONSTANTE 
                    
            }
            public function getUploadLocationDir(){
                // On retourne le chemin relatif vers l'image pour un navigateur media/cache/cga/
                    return 'media/images/location/';// EN FAIRE UNE CONSTANTE 
                    
            }
            
            protected function getUploadRootDir(){
                // On retourne le chemin relatif vers l'image pour notre code PHP media/cache/cga/
                     return __DIR__.'/../../../../web/'.$this->getUploadDir();
            }
            // NORMAL
            public function getWebPath(){ return $this->getUploadDir().$this->id.'_'.$this->getUrl();  }
            public function getWebPath2() { return $this->getUploadDir().$this->id.'_'.$this->getUrl2();  }
            public function getWebPath3()  { return $this->getUploadDir().$this->id.'_'.$this->getUrl3();  }
            //150
             public function getResizePath(){ return $this->getResizeDir().$this->id.'_'.$this->getUrl();  }
            public function getResizePath2() { return $this->getResizeDir().$this->id.'_'.$this->getUrl2();  }
            public function getResizePath3()  { return $this->getResizeDir().$this->id.'_'.$this->getUrl3();  }
            //450
             public function getLocationPath(){ return $this->getUploadLocationDir().$this->id.'_'.$this->getUrl();  }
            public function getLocationPath2() { return $this->getUploadLocationDir().$this->id.'_'.$this->getUrl2();  }
            public function getLocationPath3()  { return $this->getUploadLocationDir().$this->id.'_'.$this->getUrl3();  }
            
            
             function traiterPreRemoveU($tempFilename, $url ){
                     // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
                 $tempFilename = $this->getUploadRootDir().$url;
        }
        
        function traiterPostRemoveU($tempFilename){
           // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
                      if (file_exists($tempFilename)) {// On supprime le fichier
                      unlink($tempFilename);
                      }
                    $tempFilename = str_replace('upload', 'location', $tempFilename);
                     if (file_exists($tempFilename)) {// On supprime le fichier
                      unlink($tempFilename);
                      }
                  $tempFilename = str_replace('location', 'pictos', $tempFilename);
                     if (file_exists($tempFilename)) {// On supprime le fichier
                      unlink($tempFilename);
                      }
        }
}