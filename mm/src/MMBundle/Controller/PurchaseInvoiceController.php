<?php

namespace MMBundle\Controller;

use MMBundle\Entity\PurchaseInvoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Purchaseinvoice controller.
 *
 * @Route("purchaseinvoice")
 */
class PurchaseInvoiceController extends Controller
{
    /**
     * Lists all purchaseInvoice entities.
     *
     * @Route("/", name="purchaseinvoice_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $purchaseInvoices = $em->getRepository('MMBundle:PurchaseInvoice')->findAll();

        return $this->render('purchaseinvoice/index.html.twig', array(
            'purchaseInvoices' => $purchaseInvoices,
        ));
    }

    /**
     * Creates a new purchaseInvoice entity.
     *
     * @Route("/new", name="purchaseinvoice_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $purchaseInvoice = new Purchaseinvoice();
        $form = $this->createForm('MMBundle\Form\PurchaseInvoiceType', $purchaseInvoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($purchaseInvoice);
            $em->flush();

            return $this->redirectToRoute('purchaseinvoice_show', array('id' => $purchaseInvoice->getId()));
        }

        return $this->render('purchaseinvoice/new.html.twig', array(
            'purchaseInvoice' => $purchaseInvoice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a purchaseInvoice entity.
     *
     * @Route("/{id}", name="purchaseinvoice_show")
     * @Method("GET")
     */
    public function showAction(PurchaseInvoice $purchaseInvoice)
    {
        $deleteForm = $this->createDeleteForm($purchaseInvoice);

        return $this->render('purchaseinvoice/show.html.twig', array(
            'purchaseInvoice' => $purchaseInvoice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing purchaseInvoice entity.
     *
     * @Route("/{id}/edit", name="purchaseinvoice_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PurchaseInvoice $purchaseInvoice)
    {
        $deleteForm = $this->createDeleteForm($purchaseInvoice);
        $editForm = $this->createForm('MMBundle\Form\PurchaseInvoiceType', $purchaseInvoice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('purchaseinvoice_edit', array('id' => $purchaseInvoice->getId()));
        }

        return $this->render('purchaseinvoice/edit.html.twig', array(
            'purchaseInvoice' => $purchaseInvoice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a purchaseInvoice entity.
     *
     * @Route("/{id}", name="purchaseinvoice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PurchaseInvoice $purchaseInvoice)
    {
        $form = $this->createDeleteForm($purchaseInvoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($purchaseInvoice);
            $em->flush();
        }

        return $this->redirectToRoute('purchaseinvoice_index');
    }

    /**
     * Creates a form to delete a purchaseInvoice entity.
     *
     * @param PurchaseInvoice $purchaseInvoice The purchaseInvoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PurchaseInvoice $purchaseInvoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('purchaseinvoice_delete', array('id' => $purchaseInvoice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
