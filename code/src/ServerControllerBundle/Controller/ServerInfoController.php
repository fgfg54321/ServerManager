<?php

namespace ServerControllerBundle\Controller;

use ServerControllerBundle\Entity\ServerInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Serverinfo controller.
 *
 */
class ServerInfoController extends Controller
{

    /**
     * getConfigAction
     * http://localhost/ServerManager/code/web/app_dev.php/serverinfo/getConfig?productName=test&serverId=T2
     * http://lcalhost/ServerManager/code/web/app_dev.php/serverinfo/getConfig?productName=test&serverId=L1
     */
    public function getConfigAction(Request $request)
    {
        $ip          = $request->getClientIp();
        if(strcmp($ip,"::1") == 0)
        {
            $productName = $request->query->get("productName");
            $serverId    = $request->query->get("serverId");

            if($productName!= null && $serverId != null)
            {
                $em = $this->getDoctrine()->getManager();

                $repository = $em->getRepository('ServerControllerBundle:ServerInfo');

                $query = $repository->createQueryBuilder('s')
                    ->where('s.serverId = :serverId')
                    ->setParameter('serverId', $serverId)
                    ->getQuery();

                $serverInfos = $query->getResult();
                $scount      = count($serverInfos);
                if ($scount > 0 && $serverInfos[0] != null)
                {
                    $serverInfo = $serverInfos[0];
                    $connectServer = $serverInfo->getToConnect();
                    if(!empty($connectServer))
                    {
                        $query = $repository->createQueryBuilder('s')
                            ->where('s.serverId = :serverId')
                            ->setParameter('serverId', $connectServer)
                            ->getQuery();

                        $connectInfos = $query->getResult();
                        $ccount = count($connectInfos);
                        if ($ccount > 0 && $connectInfos[0] != null)
                        {
                            $connectInfo = $connectInfos[0];
                            $configState = new ConfigState($connectInfo, 1, 0, "success");
                        }
                        else
                        {
                            $configState = new ConfigState(null, 0, -1, "no config connectInfo");
                        }
                    }
                    else
                    {
                        //needless connect
                        $configState = new ConfigState($serverInfo, 1, 0, "success");
                    }
                }
                else
                {
                    $configState = new ConfigState(null, 0, -2, "no config serverId");
                }
            }
            else
            {
                $configState = new ConfigState(null, 0, -3, "lack pass of param");
            }
        }
        else
        {
            $configState = new ConfigState(null, 0, -4, "no permission");
        }

        $jsonResponse = JsonResponse::create($configState, 200);

        return $jsonResponse;
    }

    public function postConfigAction(Request $request)
    {
        $ip          = $request->getClientIp();

        if(strcmp($ip,"::1") == 0)
        {

            $productName = $request->query->get("productName");
            $serverId    = $request->query->get("serverId");
            $port        = $request->query->get("port");
            if($productName!= null && $serverId != null && $port!= null)
            {
                $em = $this->getDoctrine()->getManager();

                $repository = $em->getRepository('ServerControllerBundle:ServerInfo');

                $query = $repository->createQueryBuilder('s')
                    ->where('s.serverId = :serverId')
                    ->setParameter('serverId', $serverId)
                    ->getQuery();

                $serverInfos = $query->getResult();
                $scount      = count($serverInfos);
                if ($scount > 0 && $serverInfos[0] != null)
                {
                    $serverInfo = $serverInfos[0];
                    $serverInfo->setServerIp($ip);
                    $serverInfo->setServerPort($port);
                    $em->flush($serverInfo);

                    $configState = new ConfigState(null, 0, 1, "success");
                }
                else
                {
                    $configState = new ConfigState(null, 0, -2, "no config serverId");
                }
            }
            else
            {
                $configState = new ConfigState(null, 0, -3, "lack pass of param");
            }

        }
        else
        {
            $configState = new ConfigState(null, 0, -3, "no permission");
        }

        $jsonResponse = JsonResponse::create($configState, 200);

        return $jsonResponse;
    }

    /**
     * Lists all serverInfo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $serverInfos = $em->getRepository('ServerControllerBundle:ServerInfo')->findAll();

        return $this->render('serverinfo/index.html.twig', array(
            'serverInfos' => $serverInfos,
        ));
    }

    /**
     * Creates a new serverInfo entity.
     *
     */
    public function newAction(Request $request)
    {
        $serverInfo = new Serverinfo();
        $form = $this->createForm('ServerControllerBundle\Form\ServerInfoType', $serverInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($serverInfo);
            $em->flush($serverInfo);

            return $this->redirectToRoute('serverinfo_show', array('id' => $serverInfo->getId()));
        }

        return $this->render('serverinfo/new.html.twig', array(
            'serverInfo' => $serverInfo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a serverInfo entity.
     *
     */
    public function showAction(ServerInfo $serverInfo)
    {
        $deleteForm = $this->createDeleteForm($serverInfo);

        return $this->render('serverinfo/show.html.twig', array(
            'serverInfo' => $serverInfo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing serverInfo entity.
     *
     */
    public function editAction(Request $request, ServerInfo $serverInfo)
    {
        $deleteForm = $this->createDeleteForm($serverInfo);
        $editForm = $this->createForm('ServerControllerBundle\Form\ServerInfoType', $serverInfo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('serverinfo_edit', array('id' => $serverInfo->getId()));
        }

        return $this->render('serverinfo/edit.html.twig', array(
            'serverInfo' => $serverInfo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a serverInfo entity.
     *
     */
    public function deleteAction(Request $request, ServerInfo $serverInfo)
    {
        $form = $this->createDeleteForm($serverInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($serverInfo);
            $em->flush();
        }

        return $this->redirectToRoute('serverinfo_index');
    }

    /**
     * Creates a form to delete a serverInfo entity.
     *
     * @param ServerInfo $serverInfo The serverInfo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ServerInfo $serverInfo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('serverinfo_delete', array('id' => $serverInfo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

class ConfigState
{
    public $state;
    public $error;
    public $msg;
    public $data  = array();

    function __construct($connectInfo,$state,$error,$msg)
    {
        if($connectInfo != null)
        {
            $id                                = $connectInfo->getServerId();
            $name                              = $connectInfo->getServerName();
            $connectIp                         = $connectInfo->getServerIp();
            $connectPort                       = $connectInfo->getServerPort();
            $connectStatus                     = $connectInfo->getServerStatus();

            $this->data['connectId']         = $id;
            $this->data['connectName']       = $name;
            $this->data['connectIp']         = $connectIp;
            $this->data['connectPort']       = $connectPort;
            $this->data['status']             = $connectStatus;
        }
        else
        {
            $this->data = (object)$this->data;
        }

        $this->state = $state;
        $this->error = $error;
        $this->msg    = $msg;

    }
}
