<?php

namespace MMBundle\Controller;

use MMBundle\Entity\License;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use MMBundle\Form\LicenseSearchType;
use MMBundle\Form\LicenseFilterType;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;

/**
 * License controller.
 *
 * @Route("license")
 */
class LicenseController extends Controller
{

    /**
     * Lists all License entities.
     *
     * @Route("/", name="license_index")
     * @Method({"GET", "POST"})
     */

    public function indexAction(Request $request)
    {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_PRACOWNIK')) {
            throw new \LogicException('This code should not be reached!');
        }

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new LicenseSearchType());
        $form->handleRequest($request);

        $formfilter = $this->createForm(new LicenseFilterType());
        $formfilter->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $licenses = $em->getRepository('MMBundle:License')->search($form);

            return $this->render('license/index.html.twig', array(
                'licenses' => $licenses,
                'formfilter' => $formfilter->createView(),
                'form' => $form->createView(),
            ));


        }





        if ($formfilter->isSubmitted() && $formfilter->isValid()) {
            $license = $em->getRepository('MMBundle:License')->filter($formfilter);


            $paginator = $this->get('knp_paginator');

            $licenses = $paginator->paginate(
                $license, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10
            );


            return $this->render('License/index.html.twig', array(
                'licenses' => $licenses,
                'formfilter' => $formfilter->createView(),
                'form' => $form->createView()
            ));
        }


        $dql   = "SELECT a FROM MMBundle:License a";
        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');

        $licenses = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10
        );

        return $this->render('license/index.html.twig', array(
            'licenses' => $licenses,
            'form' => $form->createView(),
            'formfilter' => $formfilter->createView(),
        ));
    }

    /**
     * Creates a new license entity.
     *
     * @Route("/new", name="license_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $license = new License();
        $form = $this->createForm('MMBundle\Form\LicenseType', $license);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($license);
            $em->flush();

            return $this->redirectToRoute('license_show', array('id' => $license->getId()));
        }

        return $this->render('license/new.html.twig', array(
            'license' => $license,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a license entity.
     *
     * @Route("/{id}", name="license_show")
     * @Method("GET")
     */
    public function showAction(License $license)
    {
        $deleteForm = $this->createDeleteForm($license);

        return $this->render('license/show.html.twig', array(
            'license' => $license,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing license entity.
     *
     * @Route("/{id}/edit", name="license_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, License $license)
    {
        $deleteForm = $this->createDeleteForm($license);
        $editForm = $this->createForm('MMBundle\Form\LicenseType', $license);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('license_edit', array('id' => $license->getId()));
        }

        return $this->render('license/edit.html.twig', array(
            'license' => $license,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a license entity.
     *
     * @Route("/{id}", name="license_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, License $license)
    {
        $form = $this->createDeleteForm($license);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($license);
            $em->flush();
        }

        return $this->redirectToRoute('license_index');
    }

    /**
     * Creates a form to delete a license entity.
     *
     * @param License $license The license entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(License $license)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('license_delete', array('id' => $license->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
