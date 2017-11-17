<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
    * @Route("/test", name="test")
    */
    public function testAction(Request $request)
    {
      $logger = $this->get("logger");
      $client = $request->headers->get("X-Forwarded-For",$request->getClientIp());
      $page = "/test";
      $context = array("client" => $client, "page" => $page);
      $logger->info("test", $context);
      return new Response(
        "<html><body>Test Page</body></html>"
      );
    }
}
