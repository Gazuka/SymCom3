<?php

namespace App\Controller;

use App\Entity\Pdf;
use App\Form\PdfType;
use App\Form\DragDropType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Imagick;

class AdminPdfController extends AbstractController
{
    private $cheminDesPdf = "pdf_tmp/";
    private $cheminDesPdfPublic = "pdf/";
    private $typeDePdf;

    protected function formDragDrop(Request $request)
    {
        //On crée le formulaire
        $form = $this->createForm(DragDropType::class);
        $form->handleRequest($request);

        //On vérifie si il est Valide
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $file = $form['attachment']->getData();
            $someNewFilename = $file->getClientOriginalName();
            $file->move($this->cheminDesPdf.$this->typeDePdf, $someNewFilename);
        }

        //On crée la vue du formulaire
        $form = $form->createView();

        return $form;
    }

    /** Liste les pdfs orphelins
     * @Route("/admin/pdf/{type}", name="admin_pdf")
     */
    public function index(Request $request, ObjectManager $manager, string $type)
    {
        //Si le dossier des pdf à traiter n'existe pas nous le créont
        if(!file_exists ($this->cheminDesPdf)){mkdir($this->cheminDesPdf);}
        if(!file_exists ($this->cheminDesPdfPublic)){mkdir($this->cheminDesPdfPublic);}

        $this->typeDePdf = "$type/";
        $pdfs = $this->recherchePdfOrphelin();

        $formDrag = $this->formDragDrop($request);

        if(sizeof($pdfs)!=0)
        {
            $pdf = $pdfs[0];
            $form = $this->createForm(PdfType::class, $pdf);
            //On prépare l'envoi vers le twig
            //On vérifie si un formulaire est valide
            $form->handleRequest($request);

            
            //On vérifie que le formulaire soit Soumis et valide
            if($form->isSubmitted() && $form->isValid()) 
            {
                //On déplace le pdf
                //Si le dossier n'existe pas on le crée
                if(!file_exists ($this->cheminDesPdfPublic.$this->typeDePdf)){mkdir($this->cheminDesPdfPublic.$this->typeDePdf);}
                $nom = $pdf->getChemin();
                $nouveau = $this->typeDePdf.time()."_".$nom;
                $pdf->setChemin($nouveau);
                rename($this->cheminDesPdf.$this->typeDePdf.$nom, $this->cheminDesPdfPublic.$nouveau);
                
                if($type == 'bulletin' && class_exists('Imagick'))
                {
                    echo phpinfo();
                    //On crée une miniature de la première page du pdf en png
                    $im = new Imagick($this->cheminDesPdfPublic.$nouveau);
                    $im->setIteratorIndex(0);
                    $im->setCompression(Imagick::COMPRESSION_LZW);
                    $im->setCompressionQuality(90);
                    $im->writeImage($this->cheminDesPdfPublic.$nouveau."png");
                }

                //On persist l'élément
                $pdf->setType($type);
                $manager->persist($pdf);
                //On enregistre le tout
                $manager->flush();
                return $this->redirectToRoute('admin_pdf', ['type' => $type]);
            }   
            $form = $form->createView();

            return $this->render('/admin/admin_pdf/index.html.twig', [
                'controller_name' => 'AdminPdfController',
                'titre' => 'Recherche des PDFs orphelins',
                'form' => $form,
                'pdf' => $pdf,
                'fini' => false,
                'pdfRestant' => sizeof($pdfs),
                'dossier' => $this->typeDePdf,
                'formdrag' => $formDrag
            ]);
        }
        else
        {
            return $this->render('/admin/admin_pdf/index.html.twig', [
                'controller_name' => 'AdminPdfController',
                'titre' => 'Recherche des PDFs orphelins',
                'fini' => true,
                'pdfRestant' => 0,
                'formdrag' => $formDrag
            ]);
        }
        
    }

    /** Recherche tous les fichier pdf du dossier "$cheminDesPdf"
     * 
     * 
     * @return Array
     */
    private function recherchePdfOrphelin()
    {
        if(file_exists ($this->cheminDesPdf.$this->typeDePdf))
        {
            $pdfs = scandir($this->cheminDesPdf.$this->typeDePdf);        
            $pdfs = array_map(array($this, 'recherchePdfOrphelin_2'), $pdfs);
            $pdfs = array_values(array_filter($pdfs));
        }
        else
        {
            $pdfs = array();
        }
        return $pdfs;
    }
    private function recherchePdfOrphelin_2($nomFichier)
    {
        if(is_dir($this->cheminDesPdf.$nomFichier) || !strstr($this->cheminDesPdf.$nomFichier, '.pdf'))
        {
            return false;
        }
        else
        {
            $pdf = new Pdf();
            $pdf->setChemin($nomFichier);
            return $pdf;
        }        
    } 
}
