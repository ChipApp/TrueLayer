<?php

namespace TrueLayer\Bank\Card;

use TrueLayer\Authorize\Token;
use TrueLayer\Connection;
use TrueLayer\Request;
use TrueLayer\Data\CardBalance;

class Balance extends Request
{
    /**
     * Get card balance
     * 
     * @param string $account_id
     * @return mixed
     */
    public function get($account_id)
    {
        $result = $this->connection
            ->setAccessToken($this->token->getAccessToken())
            ->get("/data/v1/cards/" . $account_id . "/balance");

        if((int)$result->getStatusCode() > 400) { 
            throw new OauthTokenInvalid;
        }

        $data = json_decode($result->getBody(), true);
        return new CardBalance($data['results']);
    }
}