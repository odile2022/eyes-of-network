#!/bin/sh

# ansible-playbook iosconfig.yml -i hosts -u hermine -k
ansible-playbook iosconfig.yml -i hosts.json --extra-vars "@/srv/eyesofnetwork/eonweb.dev/ansible/test/vars.json"