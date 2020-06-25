
//Ítens de coleta
const serviceSelect = document.querySelectorAll(".items-grid li")

for(const item of serviceSelect) {
    item.addEventListener("click", handleSelectedItem)
}

let selectedItems = []

function handleSelectedItem(event) {
    const itemLi = event.target
    
    //adicionar ou remover uma classe com JS
    itemLi.classList.toggle("selected")
    
    const itemId = itemli.dataset.id

    //Verificae se existem items selecionados, se sim 
    //Pegar os itens selecionados

    const alreadySelected = selectedItems.findIndex( item => {
        const itemFound = item === itemId // Isso será true ou false
        return itemFound
    })

    //Se já estiver selecionado,tirar da selecao

    if(alreadySelected >= 0) {
        // tirar da seleção
        const filteredItems = selectedItems.filter( item => {
            const itemIsDifferent = item != ItemId
            return itemIsDifferent
        })
    }
    //Se não estiver selecionado, adicionar à seleção
    //Atualizar o campo escondido com os itens selecionados
      


}