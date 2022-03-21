#!/bin/sh

# ansible-playbook iosconfig.yml -i hosts -u hermine -k
ansible-playbook iosconfig.yml -i hosts --extra-vars "@/srv/eyesofnetwork/eonweb/ansible/test/vars.json"