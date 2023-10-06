#!/bin/bash

cd capywatch-ui && npm install && npm run build -- --base=/dist/ && \
rm -Rf ../public/dist && mv dist ../public/
