#!/bin/sh

echo "Generating OpenAPI code ..."

cd "$(dirname "$0")"
rm -rf .gen
mkdir -p .gen
cd .gen

curl -s -O https://apireference.cloud.corbado.io/backendapi-v2/backend_api.yml
docker pull openapitools/openapi-generator-cli
docker run -v ${PWD}:/local openapitools/openapi-generator-cli generate -i /local/backend_api.yml -g php -o /local --additional-properties=invokerPackage=Corbado\\Generated
cp -r lib/* ../../src/Generated

cd ..
rm -rf .gen

echo " done!"