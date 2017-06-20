<?php

namespace BlogBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
	/**
	 * @var string $targetDir
	 */
	private $targetDir;

	/**
	 * FileUploader constructor.
	 */
	public function __construct($targetDir)
	{
		$this->targetDir = $targetDir;
	}

	public function upload(UploadedFile $file)
	{
		// On donne un nom unique au fichier grâce a uniqudId et on récupère l'extension
		$fileName = uniqid() . '.' . $file->guessExtension();
		// Définition de la balise alt
		$altName = $file->getClientOriginalName();

		// Upload du fichier
		// move prend deux arguments en paramètre:
		// 1 ==> l'endroit ou l'on souhaite uploader
		// 2 ==> le nom du fichier qu'il prendra une fois sur le serveur
		$file->move(
			$this->targetDir,
			$fileName
		);

		return ["fileName" => $fileName, "altName" => $altName];
	}
}