ping:
	ansible all -m ping -i hosts.yml
uptime:
	ansible all -a 'uptime' -i hosts.yml
info:
	ansible debian_pure_2 -m setup -i hosts.yml
uname:
	ansible all -a "uname -a" -i hosts.yml
tasks:
	ansible-playbook -i hosts.yml tasks.yml
upgrade:
	ansible-playbook -i hosts.yml upgrade.yml
list-tasks:
	ansible-playbook -i hosts.yml tasks.yml --list-tasks --list-hosts
poweroff:
	ansible -m shell -a "init 0" all -i hosts.yml