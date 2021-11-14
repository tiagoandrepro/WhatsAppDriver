<?php

namespace WhatsAppDriver;

use BotMan\BotMan\Drivers\HttpDriver;
use BotMan\BotMan\Interfaces\DriverInterface;
use BotMan\BotMan\Interfaces\UserInterface;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WhatsAppDriver extends HttpDriver
{

    protected $myData = [];

    public function matchesRequest()
    {
        return isset($this->myData['driver_specific_request']);
    }

    public function getMessages()
    {
        return [new Message($this->myData['text'], $this->myData['sender_id'], $this->myData['recipient_id'])];
    }

    public function isConfigured()
    {
        return ! empty($this->config->get('token')) && ! empty($this->config->get('endPoint'));
    }

    public function getUser(IncomingMessage $matchingMessage)
    {
        return new User($matchingMessage->getChannel());
    }

    public function getConversationAnswer(IncomingMessage $message)
    {
        return Answer::create($message->getMessage());
    }

    public function buildServicePayload($message, $matchingMessage, $additionalParameters = [])
    {
        // TODO: Implement buildServicePayload() method.
    }

    public function sendPayload($payload)
    {
        // TODO: Implement sendPayload() method.
    }

    public function buildPayload(Request $request)
    {
        $this->myData = $request->request->all();
    }

    public function sendRequest($endpoint, array $parameters, IncomingMessage $matchingMessage)
    {
        $url = $this->config->get('api_url');
        $this->http->post($url, [], $parameters);
    }
}