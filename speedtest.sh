#!/bin/bash

ssh gatekeeper "speedtest --format=json 2>&1" > ./speedtest.json
curl -F "file=@./speedtest.json" http://127.0.0.1:8000/api/v1/speedtest

#unlink ./speedtest.json
