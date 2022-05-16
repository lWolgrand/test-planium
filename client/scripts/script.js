window.onload = () => {
    const title = document.getElementById('title');
    title.innerHTML += getPlanId();
};
function getPlanId() {
    const queryString = window.location.search;
    return queryString.split('=')[1];
    
}
function adicionarBeneficiario(e){
    e.preventDefault();
    const campos = `<div class="form-group">
    <label for="name">Nome beneficiario</label>
    <input type="text" class="nome form-control" aria-describedby="name" placeholder="Nome do beneficiario">              
  </div>

  <div class="form-group">
    <label for="idade">Idade</label>
    <input type="text" class="idade form-control" placeholder="Idade">
  </div>`;

    const inputs = document.getElementById('inputs');  
    inputs.innerHTML += campos; 
}

async function enviarSolicitaçao(e){
    e.preventDefault();
    const nomes = document.querySelectorAll('.nome');    
    const idades = document.querySelectorAll('.idade');
    const solicitaçao = {
        plan_name: `Bitix Customer Plano - ${getPlanId()}`,
        plan_register: `reg${getPlanId()}`,
        beneficiary_amount: nomes.length,
        beneficiaries: []
    }
    for(let i = 0; i < nomes.length; i++){
        solicitaçao.beneficiaries.push({
            beneficiary_name: nomes[i].value,
            beneficiary_age: idades[i].value
        })    
    }
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(solicitaçao)
    }
    try {
        const response = await fetch('http://localhost:80/plan', options);
        const data = await response.json();
        console.log(data);    
    } catch (error) {
        console.log(error);
    }


}



document.getElementById('add').addEventListener('click', adicionarBeneficiario);
document.getElementById('submit').addEventListener('click', enviarSolicitaçao);

 


