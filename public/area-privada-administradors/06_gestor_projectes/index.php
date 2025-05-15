<h2>Project manager</h2>


<input type='hidden' id='url' value='' />
<div class="table-responsive">
    <table class="table table-striped" id="projects">
        <thead class="table-primary">
            <tr>
                <th>Project name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Priority</th>
                <th>Client</th>
                <th></th>
                <th></th>

        </thead>
        <tbody></tbody>
    </table>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function fetch_data() {
            const urlAjax = "/api/projects/?type=projects";

            fetch(urlAjax, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    let html = '';

                    data.forEach(project => {
                        html += '<tr>';
                        html += `<td>${project.nomProjecte}</td>`;
                        html += `<td>${project.descripcioProjecte}</td>`;

                        // Estado del proyecto
                        html += '<td>';
                        if (project.estatProjecte == "1") {
                            html += '<button type="button" class="btn btn-sm btn-danger">To do</button>';
                        } else if (project.estatProjecte == "2") {
                            html += '<button type="button" class="btn btn-sm btn-dark">In progress</button>';
                        } else if (project.estatProjecte == "3") {
                            html += '<button type="button" class="btn btn-sm btn-warning">In review</button>';
                        } else if (project.estatProjecte == "4") {
                            html += '<button type="button" class="btn btn-sm btn-success">Done</button>';
                        }
                        html += '</td>';

                        html += `<td>${project.dataIniciProjecte}</td>`;
                        html += `<td>${project.dataActualitzacioProjecte}</td>`;

                        // Prioridad del proyecto
                        html += '<td>';
                        if (project.prioritatProjecte == "1") {
                            html += '<button type="button" class="btn btn-sm btn-success">Low</button>';
                        } else if (project.prioritatProjecte == "2") {
                            html += '<button type="button" class="btn btn-sm btn-primary">Moderate</button>';
                        } else if (project.prioritatProjecte == "3") {
                            html += '<button type="button" class="btn btn-sm btn-danger">High</button>';
                        }
                        html += '</td>';

                        html += `<td>${project.clientEmpresa}</td>`;

                        html += `<td>
                    <button type="button" onclick="btnUpdateBook(${project.id})" class="btn btn-sm btn-warning"
                        data-bs-toggle="modal" data-bs-target="#modalUpdateBook"
                        data-id="${project.id}" value="${project.id}" 
                        data-title="${project.id}" data-slug="${project.id}" data-text="${project.id}">
                        Update
                    </button>
                </td>`;

                        html += `<td>
                    <button type="button" onclick="btnUpdateBook(${project.id})" class="btn btn-sm btn-danger"
                        data-bs-toggle="modal" data-bs-target="#modalUpdateBook"
                        data-id="${project.id}" value="${project.id}" 
                        data-title="${project.id}" data-slug="${project.id}" data-text="${project.id}">
                        Delete
                    </button>
                </td>`;

                        html += '</tr>';
                    });

                    document.querySelector("#projects tbody").innerHTML = html;
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                });
        }

        fetch_data();
    });
</script>