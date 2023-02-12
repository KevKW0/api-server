const tbody = document.querySelector('tbody')
const searchInput = document.querySelector('search-input')
let mhsData = []

const loadData = async () => {
    try {
        const url = await fetch('http://localhost:8080/api-server/mahasiswa')
        mhsData = await url.json()
        loadMhsData(mhsData)
    } catch (error) {
        console.log(error)
    }
}

const loadMhsData = (element) => {
    let no = 1
    const output = element.data.map((mhs) =>{
        return `<tr>
                <td id="noEdit">`+ (no++) +`</td>
                    <td>${mhs.name}</td>
                    <td>${mhs.npm}</td>
                    <td>${mhs.phone}</td>
                    <td>${mhs.email}</td>
                    <td><button type="button" onclick="editMhs()" data="`+ mhs.id +`" class="btn btn-warning" id="edit-button">
                    Edit
                </button> <button type="button" onclick="deleteMhs()" data="`+ mhs.id +`" class="btn btn-danger" id="delete-button">Delete</button></td>
            </tr>`
    }).join('')
    tbody.innerHTML = output
}

function addMhs() {
    $(document).ready(function () {
        $('#modal-form').modal('show')
        $('#modal-form .modal-title').text('Tambah Mahasiswa')
        $('#modal-form form')[0].reset()
        $('#submit-data').click(function () {
            const name = $('#name').val()
            const npm = $('#npm').val()
            const phone = $('#phone').val()
            const email = $('#email').val()
    
            $.ajax ({
                type: 'POST',
                url: 'http://localhost:8080/api-server/mahasiswa',
                data: {
                    name    : name,
                    npm     : npm,
                    phone   : phone,
                    email   : email,
                },
                success: function() {
                    alert('Data Saved Successfully')
                    location.reload()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error: ' + errorThrown)
                }
            })
        })
    
    })
}

function editMhs() {
    $(document).on('click', '#edit-button', function() {
            $('#modal-form').modal('show')
            $('#modal-form .modal-title').text('Edit Mahasiswa')
            $('#modal-form form')[0].reset()
            
            // Menampilkan Data yang akan diedit
            let id = $(this).attr('data')
            console.log(id)
            $.ajax({
                method: 'GET',
                url: `http://localhost:8080/api-server/mahasiswa/`+ id +``,
                success: function(result) {
                    console.log(result)
                    $('#name').val(result.data.name)
                    $('#npm').val(result.data.npm)
                    $('#phone').val(result.data.phone)
                    $('#email').val(result.data.email)
                }
            })

            $('#submit-data').click(function() {
                // Ambil Hasil Edit Data
                let name = $('#name').val()
                let npm = $('#npm').val()
                let phone = $('#phone').val()
                let email = $('#email').val()

            $.ajax({
                method: 'PUT',
                url: 'http://localhost:8080/api-server/mahasiswa/',
                data: {
                    name: name,
                    npm: npm,
                    phone: phone,
                    email: email,
                },
                success: function() {
                    alert('Data Updated Successfully ')
                    location.reload()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error: ' + errorThrown)
                }
            })
            })
    })
}

function deleteMhs() {
    $(document).on('click', '#delete-button', function () {
        let id = $(this).attr('data')
        // Request ke Api Server untuk delete data
        $.ajax({
            method: 'DELETE',
            url: `http://localhost:8080/api-server/mahasiswa/`+ id +``,
            success: function() {
                alert('Data Updated Successfully ')
                location.reload()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error: ' + errorThrown)
            }
        })
    })
}


loadData()
