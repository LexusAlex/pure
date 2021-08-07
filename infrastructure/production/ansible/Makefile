ping:
	ansible all -m ping -i inventory/hosts.yml
uptime:
	ansible all -a 'uptime' -i inventory/hosts.yml
info:
	ansible debian_pure_2 -m setup -i inventory/hosts.yml
uname:
	ansible all -a "uname -a" -i inventory/hosts.yml
tasks:
	ansible-playbook -i inventory/hosts.yml tasks.yml
upgrade:
	ansible-playbook -i inventory/hosts.yml upgrade.yml
list-tasks:
	ansible-playbook -i inventory/hosts.yml tasks.yml --list-tasks --list-hosts
poweroff:
	ansible -m shell -a "init 0" all -i inventory/hosts.yml
install:
	ansible-playbook -i inventory/hosts.yml all.yml
debug:
	ansible-playbook -i inventory/hosts.yml all.yml
uninstall:
	ansible-playbook -i inventory/hosts.yml soft/nginx/nginx_uninstall.yml