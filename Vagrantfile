# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/jammy64"
  
  config.vm.provider "virtualbox" do |vb|
  vb.name="Entorno de desarrollo WebFusion Digital S.L"
  vb.memory="4096"
  vb.cpus=2
  config.vm.network "forwarded_port", guest: 8080, host: 8080
  
  
  #activamos la virtualizacion anidada, pues docker pudiera presentar fallos sin ello
  vb.gui=true
  vb.customize ["modifyvm", :id, "--nested-hw-virt", "on"]
  end
  
  
  #Preparacion de programas
  config.vm.provision "shell",run: "always", inline: <<-SHELL
#instalacion y config git

#me dio un chingo de errores pero por fin funciona el puñetero arte ascii GGs
echo '
     ____  _                            _     _        
    |  _ \(_)                          (_)   | |       
    | |_) |_  ___ _ ____    _____ _ __  _  __| |___   
    |  _ <| |/ _ \ '_ \ \ / / _ \ '_ \| |/ _` |/ _ \  
    | |_) | |  __/ | | \ V /  __/ | | | | (_| | (_) | 
    |____/|_|\___|_| |_|\_/ \___|_| |_|_|\__,_|\___/  
    '

#INSTALACION Y CONFIG DOCKER
if ! command -v docker &> /dev/null; then
echo 'instalando y configurando docker'
apt-get update
apt-get install -y apt-transport-https ca-certificates curl gnupg-agent software-properties-common
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc
    
tee /etc/apt/sources.list.d/docker.sources <<EOF
Types: deb
URIs: https://download.docker.com/linux/ubuntu
Suites: $(. /etc/os-release && echo "${UBUNTU_CODENAME:-$VERSION_CODENAME}")
Components: stable
Signed-By: /etc/apt/keyrings/docker.asc
EOF
  
sudo apt-get -y update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io 

echo 'configurando permisos de usuario'
usermod -aG sudo vagrant
usermod -aG docker vagrant
echo 'instalacion finalizada'

else
  echo "docker ya instalado, prosiguiendo a instalar docker compose"
fi


#DOCKER COMPOSE
if ! docker compose version &> /dev/null; then
'iniciando instalacion de docker compose'
sudo apt install gnome-terminal
sudo apt-get update
sudo apt-get install docker-compose-plugin
echo 'instalacion finalizada. Procediendo a configurar el entorno'
else
  echo "docker compose ya se encuentra instalado, el sistema procedera a levantar los contenedores y configurar el entorno"
fi


#ACOMODANDO SETUP
echo "iniciando apps"
    cd /vagrant
    sudo docker compose up -d
    sudo docker compose start git-helper #esto es para forzar el cargado del repositorio
    sleep 20
    
    
  SHELL
  
end
