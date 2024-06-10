#!/bin/bash

ssh $1 "speedtest --format=json 2>&1" > ./$1.json
curl -F "file=@./${1}.json" http://127.0.0.1:8000/api/v1/speedtest
unlink ./$1.json
