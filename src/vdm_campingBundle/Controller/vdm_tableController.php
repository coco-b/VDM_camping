<?php

namespace vdm_campingBundle\Controller;

use vdm_campingBundle\Entity\vdm_table;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vdm_table controller.
 *
 */
class vdm_tableController extends Controller
{
    /**
     * Lists all vdm_table entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vdm_tables = $em->getRepository('vdm_campingBundle:vdm_table')->findAll();

        return $this->render('@vdm_camping/Default/index.html.twig', array(
            'vdm_tables' => $vdm_tables,
        ));
    }

    /**
     * Creates a new vdm_table entity.
     *
     */
    public function newAction(Request $request)
    {
        $vdm_table = new Vdm_table();
        $form = $this->createForm('vdm_campingBundle\Form\vdm_tableType', $vdm_table);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vdm_table);
            $em->flush($vdm_table);

            return $this->redirectToRoute('vdm_table_show', array('id' => $vdm_table->getId()));
        }

        return $this->render('@vdm_camping/vdm_table/new.html.twig', array(
            'vdm_table' => $vdm_table,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vdm_table entity.
     *
     */
    public function showAction(vdm_table $vdm_table)
    {
        $deleteForm = $this->createDeleteForm($vdm_table);

        return $this->render('@vdm_camping/vdm_table/show.html.twig', array(
            'vdm_table' => $vdm_table,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vdm_table entity.
     *
     */
    public function editAction(Request $request, vdm_table $vdm_table)
    {
        $deleteForm = $this->createDeleteForm($vdm_table);
        $editForm = $this->createForm('vdm_campingBundle\Form\vdm_tableType', $vdm_table);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vdm_table_edit', array('id' => $vdm_table->getId()));
        }

        return $this->render('@vdm_camping/vdm_table/edit.html.twig', array(
            'vdm_table' => $vdm_table,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vdm_table entity.
     *
     */
    public function deleteAction(Request $request, vdm_table $vdm_table)
    {
        $form = $this->createDeleteForm($vdm_table);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vdm_table);
            $em->flush($vdm_table);
        }

        return $this->redirectToRoute('vdm_table_index');
    }

    /**
     * Creates a form to delete a vdm_table entity.
     *
     * @param vdm_table $vdm_table The vdm_table entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(vdm_table $vdm_table)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vdm_table_delete', array('id' => $vdm_table->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
