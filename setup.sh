echo "Criando arquivos..."

echo '[{"nome":"borginhos","opaque":"1516e33405e60117ced315c0eb64d416a7963380454604a923c92c4469133b4192412ee30e73cf2d3e8e7f5822d09d0a6cf33b1b15de5017b50b308ab5fae1e8","salt":"56b7fac6cc51d8.53117610"}]'>outros/credenciais.json
echo "[]">outros/resumos.json

echo "Setando permissões..."
chmod 777 outros/credenciais.json
chmod 777 outros/resumos.json

echo "Tudo pronto!"