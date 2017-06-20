<?php

namespace BlogBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Picture
 */
class Picture
{
	/**
	 * Attribut virtuel qui accueil le fichier asisi dans notre formulaire
	 * @var UploadedFile $file
	 */
	private $file;

	/**
	 * Attribut permettant de stocker le nom de mon fichier en preRemove
	 * @var string $tempName
	 */
	private $tempName;

	/**
	 * @return UploadedFile
	 */
	public function getFile()
	{
		return $this->file;
	}

	/**
	 * @param UploadedFile $file
	 */
	public function setFile(UploadedFile $file)
	{
		$this->file = $file;

		if ($this->src != null){
			// On stock le nom de l'image à supprimer
			$this->tempName = $this->src;

			// On réinitialise les champs de notre objet
			$this->src = null;
			$this->alt= null;
		}
	}

	/**
	 * Ce qu'il se passe avant l'upload
	 * @ORM\PrePersist
	 * @ORM\PreUpdate
	 */
	public function preUpload()
	{
		// Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
		if (null === $this->file) {
			return;
		}

		// On donne un nom unique au fichier grâce a uniqudId et on récupère l'extension
		$this->src = uniqid() . '.' . $this->file->guessExtension();
		// Définition de la balise alt
		// getClientOriginalName() récupère le nom complet du fichier (extension comprise)
		// Du coup on récupère nom original + extension, et grâce à str_replace, et ré-cré un le alt du fichier avec
		// le nom original du fichier tel qu'il etait sur la machine du client sans l'extension.
		$alt = $this->file->getClientOriginalName();
		$ext = $this->file->guessExtension();
		$this->alt = str_replace('.'.$ext, '', $alt);
	}

	/**
	 * @ORM\PostPersist
	 * @ORM\PostUpdate
	 */
	public function upload()
	{
		// Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
		if (null === $this->file) {
			return;
		}

		if ($this->tempName != null){
			// On récupère l'adresse du fichier à supprimer
			$oldFile = $this->getUploadDir() . $this->tempName;

			// On vérifie que le fichier à supprimer exist
			if (file_exists($oldFile)){
				unlink($oldFile);
			}
		}

		$this->file->move($this->getUploadDir(), $this->src);
	}

	/**
	 * @ORM\PostRemove
	 */
	public function remove()
	{
		// On récupère l'adresse du fichier à supprimer
		$fileToRemove = $this->getUploadDir() . $this->src;

		// On vérifie que le fichier exist
		if (file_exists($fileToRemove)){
			unlink($fileToRemove);
		}
	}

	private function getUploadDir()
	{
		return __DIR__ . '/../../../web/uploads/images/';
	}

	// GENERATED CODE

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $src;

    /**
     * @var string
     */
    private $alt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set src
     *
     * @param string $src
     *
     * @return Picture
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Picture
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
}
