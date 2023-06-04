<?php

interface HttpService {
    public function request(string $url, string $requestType, array $options = []);
}

class XMLHTTPRequestService implements HttpService {
    public function request(string $url, string $requestType, array $options = [])
    {
        // Making request
    }
}

class XMLHttpService extends XMLHTTPRequestService {} // or "implements HttpService" here

class Http {
    public function __construct(
        private HttpService $httpService
    ) {}

    public function get(string $url, array $options) {
        $this->httpService->request($url, 'GET', $options);
    }

    public function post(string $url) {
        $this->httpService->request($url, 'POST');
    }
}
