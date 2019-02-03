<?php

namespace TrueLayer\Bank\Account;

use TrueLayer\Authorize\Token;
use TrueLayer\Connection;
use TrueLayer\Request;
use TrueLayer\Data\Balance as Data;

class Balance extends Request
{
    /**
     * Get account balance
     * 
     * @param string $account_id
     * @return mixed
     */
    public function get($account_id)
    {
        $result = $this->connection
            ->setAccessToken($this->token->getAccessToken())
            ->get("/data/v1/accounts/" . $account_id . "/balance");

        if((int)$result->getStatusCode() > 400) { 
            throw new OauthTokenInvalid;
        }

        $data = json_decode($result->getBody(), true);
        return new Data($data["results"]);
    }
}