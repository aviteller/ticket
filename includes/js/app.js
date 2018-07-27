const http = new EasyHttp();
const companyFormGroup = document.querySelector('#company-form-group');



document.addEventListener('DOMContentLoaded', () => {
  loadData();
});


document.addEventListener('change', (e) => {
  if(e.target && e.target.id == 'Company'){
    if(e.target.value == 'other-option'){
      makeCompanySelectIntoTextBox();
    }
  }
});



document.addEventListener('click', (e) => {
  if(e.target && e.target.id == 'cancel-other-option'){
    getCompanies();
    e.preventDefault();
  }
});

document.addEventListener('focusout', (e) => {
  if(e.target && e.target.className == 'notes'){

    const data = {
      id : e.target.id,
      notes : e.target.innerHTML,
    }

    http.post('controller.php?m=updateNote', data)
      .then(data => {getTickets(); getCompanies()})
      .catch(err => console.log(err));
    e.preventDefault();
  }
});

document.addEventListener('focusout', (e) => {
  if(e.target && e.target.classList.contains('priority')){
    const data = {
      id : e.target.id,
      priority : e.target.value,
    }

    http.post('controller.php?m=updatePriority', data)
      .then(data => {getTickets(); getCompanies()})
      .catch(err => console.log(err));
    e.preventDefault();
  }
});

document.addEventListener('click', (e) => {
  if(e.target && e.target.className == 'delete-ticket'){
    http.post('controller.php?m=deleteTicket', e.target.id)
      .then(data => {getTickets(); getCompanies()})
      .catch(err => console.log(err));
    e.preventDefault();
  }
});

document.addEventListener('click', (e) => {
  if(e.target && e.target.className == 'delete-ticket'){
    http.post('controller.php?m=deleteTicket', e.target.id)
      .then(data => {getTickets(); getCompanies()})
      .catch(err => console.log(err));
    e.preventDefault();
  }
});

document.addEventListener('change', (e) => {
  if(e.target && e.target.className == 'complete-checkbox'){
    http.post('controller.php?m=completeTicket', e.target.id)
      .then(data => {getTickets(); getCompanies()})
      .catch(err => console.log(err));
    e.preventDefault();
  }
});

document.addEventListener('change', (e) => {
  if(e.target && e.target.className == 'incomplete-checkbox'){
    http.post('controller.php?m=incompleteTicket', e.target.id)
      .then(data => {getTickets(); getCompanies()})
      .catch(err => console.log(err));
    e.preventDefault();
  }
});



document.querySelector('#ticket-form').addEventListener('submit', (e) =>{
  e.preventDefault();

  const name = document.querySelector('#Name');
  const description = document.querySelector('#Description');
  const company = document.querySelector('#Company');
  const date = document.querySelector('#Date');
  
  const data = {
    name : name.value,
    description : description.value,
    company : company.value,
    date : date.value,
  }

  http.post('controller.php?m=addTicket', data)
    .then(data => {getTickets()})
    .catch(err => console.log(err));

  name.value = '';
  description.value = '';
  company.value = '';
  date.value = '';

});

function loadData()
{
  getTickets();
  getCompanies();
}

function makeCompanySelectIntoTextBox()
{
  companyFormGroup.innerHTML = '';
  let label = document.createElement('label');
      label.innerHTML = 'Company';
  let input = document.createElement('input');
      input.type = 'text';
      input.id = 'Company';
      input.className = 'form-control';
  let cancel = document.createElement('button');
      cancel.id = 'cancel-other-option';
      cancel.innerHTML = 'Cancel';
  companyFormGroup.appendChild(label);
  companyFormGroup.appendChild(input);
  companyFormGroup.appendChild(cancel);
}

function getTickets()
{
  http.get('controller.php?m=getTickets')
    .then(data => {makeTicketRows(data); getCompanies()})
    .catch(err => console.log(err));
}

function getCompanies()
{
  http.get('controller.php?m=getCompanies')
    .then(data => makeCompanyOptions(data))
    .catch(err => console.log(err));
}

function makeCompanyOptions(data)
{

  companyFormGroup.innerHTML = '';
  let label = document.createElement('label');
      label.innerHTML = 'Company';
  let select = document.createElement('select');
      select.id = 'Company';
      select.className = 'form-control';

      select.innerHTML = '';
  let optionSelect = document.createElement('option');
      optionSelect.textContent = 'Please Select';
      //optionSelect.disabled = true;
      select.appendChild(optionSelect);
  data.forEach(d => {
    let option = document.createElement('option');
    option.textContent = `${d.Company}`;
    
    select.appendChild(option);
    
   
  });

  let optionOther = document.createElement('option');
  optionOther.textContent = 'Other';
  optionOther.value = 'other-option';
  select.appendChild(optionOther);
  companyFormGroup.appendChild(label);
  companyFormGroup.appendChild(select);
}


function makeTicketRows(data)
{
  const tableBody = document.querySelector(`#table-body`);
  tableBody.innerHTML = '';
  data.forEach(d => {
    let tr = document.createElement('tr');
    if(d.Completed == 1){
      tr.style.backgroundColor = 'pink';
    }

      tr.innerHTML += `<td> ${d.Name} </td>`;
      if(d.Notes != ''){
        tr.innerHTML += `<td> ${d.Description} <hr> Notes:<div class="notes" id="${d.id}" contenteditable="true">${d.Notes}</div> </td>`;
      } else {

        tr.innerHTML += `<td> ${d.Description} <hr> Notes:<div class="notes" id="${d.id}" contenteditable="true">Enter a note here</div> </td>`;
      }
      tr.innerHTML += `<td> ${d.Company} </td>`;
      tr.innerHTML += `<td> ${d.DueDate} </td>`; 
      if(d.Completed == 1){
      tr.innerHTML += `<td> <input type="checkbox" class="incomplete-checkbox" id="${d.id}" value="1" checked> </td>`;
      } else {
        tr.innerHTML += `<td> <input type="checkbox" class="complete-checkbox" id="${d.id}" value="1"> </td>`;
      }
      tr.innerHTML += `<td><input type="number" class="priority form-control" id="${d.id}" value="${d.Priority}">  </td>`;
      tr.innerHTML += `<td colspan="2"><button class="delete-ticket" id='${d.id}'>delete</button>
      <button style="display:none;" class="edit-item" id='${d.id}'>edit</button> </td>`;

      tableBody.appendChild(tr);
  });
}

