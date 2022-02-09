#!/bin/bash
DOCKER_BUILDKIT=1 docker build -t jamaissansmonriz .
docker run --rm --name jamaissansmonriz --network host -p 80:80 jamaissansmonriz
