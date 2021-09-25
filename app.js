var provincias_select = document.getElementById('provincias');
var distritos_select = document.getElementById('distritos');
var corregimientos_select = document.getElementById('corregimientos');
var div_distrito = document.getElementById('_distrito');
var div_corregimiento = document.getElementById('_corregimiento');
div_distrito.style.display = "none";
div_corregimiento.style.display = "none";

// Provincias
async function getProvincias(){
    //div_distrito.style.display = "none";
    
    var response = await fetch('api_data.php');
    var json_data = await response.json();
    console.log(json_data);

    provincias_select.innerHTML = '';
    json_data.forEach((item, index) => {
        var opcion = document.createElement('option');
        opcion.value = item.id;
        opcion.text = item.provincia;

        provincias_select.appendChild(opcion);
    });
}

// Distritos
async function getDistritos(id_prov){
    div_distrito.style.display = 'none';
    div_corregimiento.style.display = "none";
    var response = await fetch('api_data.php?type=distrito&id_provincia='+id_prov);
    var json_data = await response.json();
    console.log(json_data);
    
    distritos_select.innerHTML = '';
    json_data.forEach((item, index) => {
        var opcion = document.createElement('option');
        opcion.value = item.id;
        opcion.text = item.distrito;
        
        distritos_select.appendChild(opcion);
    });
    div_distrito.style.display = 'block';
}

// Corregimiento
async function getCorregimientos(id_dist){
    div_corregimiento.style.display = 'none';
    var response = await fetch('api_data.php?type=corregimiento&id_distrito='+id_dist);
    var json_data = await response.json();
    console.log(json_data);
    
    corregimientos_select.innerHTML = '';
    json_data.forEach((item, index) => {
        var opcion = document.createElement('option');
        opcion.value = item.id;
        opcion.text = item.corregimiento;
        
        corregimientos_select.appendChild(opcion);
    });
    div_corregimiento.style.display = 'block';
}

getProvincias();

provincias_select.onchange = function(){
    getDistritos(provincias_select.value);
}

distritos_select.onchange = function(){
    getCorregimientos(distritos_select.value);
}