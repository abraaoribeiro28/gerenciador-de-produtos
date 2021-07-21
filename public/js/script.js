// Modal de confimar se deseja excluir algo
function exibirModal(id){
    const modal = document.querySelector('.modal');
    const formExcluir = document.querySelector('#form-excluir');
    modal.style.display = 'block';  
    formExcluir.setAttribute('action', '/product/delete/'+id);
}
function fecharModal(){
    const modal = document.querySelector('.modal');
    modal.style.display = 'none';
}


//Fechar alertas de ações realizadas
function fecharMsg(){
    document.querySelector('.msg').style.display = 'none';
}


// Parte que adiciona ou remove imagem dos produtos,
// tanto no criar produtos quanto no editar produtos
function modalSelectImage(){
    const modalSelectImage = document.querySelector('#modalSelectImage');
    modalSelectImage.style.display = "flex";
}
function fecharModalSelectImage(id_tela){
    const modalSelectImage = document.querySelector('#modalSelectImage');
    const inputArchive = id_tela == 2 ? document.querySelector("#archive-edit") : document.querySelector("#archive-create");
    const imagemProduto = id_tela == 2 ? document.querySelector("#imagemProdutoEdit") : document.querySelector("#imagemProdutoCreate");
    modalSelectImage.style.display = "none";
    inputArchive.setAttribute('value', '');
    imagemProduto.setAttribute('src', '/images/products/not-image.png')
}
function confirmImage(){
    const modalSelectImage = document.querySelector('#modalSelectImage');
    const btnSelect = document.querySelector('.select-img');
    const btnRemove = document.querySelector('.remove-img');
    modalSelectImage.style.display = "none";
    btnSelect.style.display = 'none';
    btnRemove.style.display = 'block';
}
function selectImage(id, image, id_tela){
    const inputArchive = id_tela == 2 ? document.querySelector("#archive-edit") : document.querySelector("#archive-create");
    const imagemProduto = id_tela == 2 ? document.querySelector("#imagemProdutoEdit") : document.querySelector("#imagemProdutoCreate");
    inputArchive.setAttribute('value', id);
    imagemProduto.setAttribute('src', '/images/products/'+image)
}
function removeImage(id_tela){
    const inputArchive = id_tela == 2 ? document.querySelector("#archive-edit") : document.querySelector("#archive-create");
    const imagemProduto = id_tela == 2 ? document.querySelector("#imagemProdutoEdit") : document.querySelector("#imagemProdutoCreate");
    const btnSelect = document.querySelector('.select-img');
    const btnRemove = document.querySelector('.remove-img');
    inputArchive.setAttribute('value', '');
    imagemProduto.setAttribute('src', '/images/products/not-image.png');
    btnSelect.style.display = 'block';   
    btnRemove.style.display = 'none';
}