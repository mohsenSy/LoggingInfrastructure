User Activity Tracking Infrastructure
==================================

Do you need to track the activity of your web users?

Do you need a scalable and low latency infrastructure to help you in this job?

Do you need to process your logs before they are sent to their destination and
at the same time retain low latency logging?

Do you need to visualize the activity and an easy to read web interface and
query the activity for useful information?

If the answer to all of these questions is yes then you are moving in the right
direction, read along.

## What is this?
In this project we will help you to create a scalable, low latency, cost effective
and reliable user activity tracking infrastructure using different software including
**[rabbitmq](https://rabbitmq.com/)**,**[logstash](https://www.elastic.co/products/logstash)**,**[apache kafka](https://kafka.apache.org/)**,**[elasticsearch](https://www.elastic.co/products/elasticsearch)** and **[kibana](https://www.elastic.co/products/kibana)**.

Each one of these software plays an important role in our infrastructure, very soon
you will learn about all of them.

**[Ansible](https://ansible.com)** will be used to deploy this infrastructure, we will use **[docker compose](https://docs.docker.com/compose/)** for demonstration purposes here.

You can use docker in production also.

### Components
We will talk about each component by itself and describe the reason we chose to
use it here.
* RabbitMQ is the most widely deployed open source message broker in our setup it is used for achieve low latency logging without it the latency caused when sending log messages will be much higher, it can be replaced by some other components such as **[redis](https://redis.io)**, we chose RabbitMQ because of its simplicity and we have ready to use log shipper from our symfony application to it then to logstash directly.

* Logstash is used for transfering logs from RabbitMQ to apache kafka, this could be removed in the future according to needs in production environment.

* Apache Kafka is the central component in our infrastructure, it is used to process the logs sent from logstash then store them in elasticsearch, this processing may include replacing numeric user IDs with real user names from the database, this processing is done here not on the application server to minimize the latency caused by logging user activity.

* Elasticsearch this component is where all of our data is stored, with elasticsearch we can query this data to extract useful information from it.

* Kibana this last component is used to visualize the data from elasticsearch.

### Data flow

1- You need to configure your web application to send logs about user activity to local rabbitmq servers installed on the same hosts as the web application with this we achieve the lowest logging latency by avoiding any latency from the network, data is sent on the same host to different locations on the server Random Access Memory.

2- After that data is sent from rabbitmq to logstash servers and then to kafka server for processing.

3- When data arrives at kafka it is processed as required then sent to be indexed in elasticsearch.

4- At elasticsearch data is indexed and stored then you can visualize it using kibana and create custom graphs and dashboards as per your needs.

I will continuously add to this repository until it reaches a stable state and release it for production use :) 
