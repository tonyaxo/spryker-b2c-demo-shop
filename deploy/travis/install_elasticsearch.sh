#!/bin/bash

mkdir /tmp/elasticsearch
wget -O - https://download.elasticsearch.org/elasticsearch/release/org/elasticsearch/distribution/tar/elasticsearch/2.3.3/elasticsearch-2.3.3.tar.gz | tar xz --directory=/tmp/elasticsearch --strip-components=1
/tmp/elasticsearch/bin/elasticsearch --daemonize --path.data /tmp
