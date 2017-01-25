<?php

namespace CrmBundle\Controller;

use CrmBundle\Entity\Email;
use CrmBundle\Entity\Person;
use CrmBundle\Entity\Telephone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use CrmBundle\Entity\Address;
use Symfony\Component\Validator\ConstraintViolationList;


/**
 * Person controller.
 *
 * @Route("new")
 */
class PersonController extends Controller {

    /**
     * Lists all Person entities.
     *
     * @Route("/", name="new_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $people = $em->getRepository('CrmBundle:Person')->findAll();

        return $this->render('CrmBundle:Person:index.html.twig', array(
            'people' => $people,
        ));
    }

    /**
     * Creates a new Person entity.
     *
     * @Route("/new", name="new_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $person = new Person();
        //$em = $this->getDoctrine()->getManager();
        $address = new Address(); //dla edit to trzeba findOneByPerson($person)
        $email = new Email();
        $telephone = new Telephone();
        $form = $this->createForm('CrmBundle\Form\PersonType', $person);
        $emailForm = $this->createForm('CrmBundle\Form\EmailType');
        $telephoneForm = $this->createForm('CrmBundle\Form\TelephoneType');
        $addressForm = $this->createForm('CrmBundle\Form\AddressType'/*, $address*/);

        $form->handleRequest($request);
        $addressForm->handleRequest($request);
        $telephoneForm->handleRequest($request);
        $emailForm->handleRequest($request);

/*
        if ($addressForm->isSubmitted() && $addressForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('new_edit', array('id' => $person->getId()));
        }*/

        if ($form->isSubmitted()  && $addressForm->isSubmitted() && $telephoneForm->isSubmitted() && $emailForm->isSubmitted()
            )  {


            $validator = $this->get('validator');
            $errors = [];
            if (!$validator->validate($person)) {
                $errors['errorsPerson'] = $validator->validate($person);
            }

            if (!$validator->validate($address)) {
                $errors['errorsAddress'] = $validator->validate($address);
            }
            //tutaj w twigu poprawić
            if(!$validator->validate($telephone)) {
                $errors['errorsTelephone'] = $validator->validate($telephone);
            }
            if(!$validator->validate($email)) {
                $errors['errorsEmail'] = $validator->validate($email);
            }

            $person = $form->getData();
            $address = $addressForm->getData();
            $address->setPerson($person);
            $telephone = $telephoneForm->getData();
            $telephone->setPerson($person);
            $email = $emailForm->getData();
            $email->setPerson($person);


            if (count($errors) > 0) {
                return $this->render('CrmBundle:Person:new.html.twig', array(
                    'errors' => $errors,
                    'form'   => $form->createView(),
                    'address_form' => $addressForm->createView(),
                    'email_form' => $emailForm->createView(),
                    'telephone_form' => $telephoneForm->createView(),
                ));
            } else {

                $em = $this->getDoctrine()->getManager();
                $em->persist($person);
                $em->flush($person);
                $em->persist($address);
                $em->persist($telephone);
                $em->persist($email);
                $em->flush($person);

                return $this->redirectToRoute('new_show', array('id' => $person->getId()));
            }

        }

        return $this->render('CrmBundle:Person:new.html.twig', array(
            'Person' => $person,
            'form'   => $form->createView(),
            'address_form' => $addressForm->createView(),
            'email_form' => $emailForm->createView(),
            'telephone_form' => $telephoneForm->createView(),

        ));
    }

    /**
     * Finds and displays a Person entity.
     *
     * @Route("/{id}", name="new_show")
     * @Method("GET")
     */
    public function showAction(Person $person) {
        $deleteForm = $this->createDeleteForm($person);

        return $this->render('CrmBundle:Person:show.html.twig', array(
            'Person'      => $person,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Person entity.
     *
     * @Route("/{id}/edit", name="new_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Person $person) {
        $deleteForm = $this->createDeleteForm($person);
        $editForm = $this->createForm('CrmBundle\Form\PersonType', $person);
        //tutaj brakuje jeszcze znalezienia wszystkich adresów przy edycji, pobrac adres osoby i przekazac nizej zeby się uzupełnił
        //findOneByPersonId
        //łącznie z 10-12 linijek w kontrolerze treba dopisac i w formularzu
        $addressForm = $this->createForm('CrmBundle\Form\AddressType'); //array collection
        $editForm->handleRequest($request);
        $addressForm->handleRequest($request); //to można obejść ale poki co nie wiem jak ;)


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('new_edit', array('id' => $person->getId()));
        }

        if ($addressForm->isSubmitted() && $addressForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('new_edit', array('id' => $person->getId()));
        }

        return $this->render('CrmBundle:Person:edit.html.twig', array(
            'Person'      => $person,
            'edit_form'   => $editForm->createView(),
            'address_form' => $addressForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Person entity.
     *
     * @Route("/{id}", name="new_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Person $person) {
        $form = $this->createDeleteForm($person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($person);
            $em->flush($person);
        }

        return $this->redirectToRoute('new_index');
    }

    /**
     * Creates a form to delete a Person entity.
     *
     * @param Person $person The Person entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Person $person) {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('new_delete', array('id' => $person->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
