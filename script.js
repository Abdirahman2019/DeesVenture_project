document.addEventListener("DOMContentLoaded", function () {
    const companyDropdown = document.getElementById("company");
    const departmentDropdown = document.getElementById("department");
    const unitDropdown = document.getElementById("unit");
    const sectionDropdown = document.getElementById("section");

    // Add event listener to the company dropdown
    companyDropdown.addEventListener("change", function () {
        // Clear existing options in the dependent dropdowns
        departmentDropdown.innerHTML = "<option value=''>Select a department</option>";
        unitDropdown.innerHTML = "<option value=''>Select a unit</option>";
        sectionDropdown.innerHTML = "<option value=''>Select a section</option>";

        // Fetch departments based on the selected company
        const selectedCompany = companyDropdown.value;
        if (selectedCompany !== "") {
            fetchDepartments(selectedCompany);
        }
    });

    // Function to fetch departments based on the selected company
    function fetchDepartments(companyID) {
        // You can use AJAX or fetch API to make a server request here
        // In this example, we'll populate the dropdowns with static data
        const departments = [
            { id: 1, name: "Department A" },
            { id: 2, name: "Department B" },
            { id: 3, name: "Department C" }
        ];

        // Populate the department dropdown
        departmentDropdown.innerHTML = "<option value=''>Select a department</option>";
        departments.forEach(function (department) {
            departmentDropdown.innerHTML += `<option value='${department.id}'>${department.name}</option>`;
        });
    }

    // Add event listener to the department dropdown (similar logic for unit and section)
    departmentDropdown.addEventListener("change", function () {
        unitDropdown.innerHTML = "<option value=''>Select a unit</option>";
        sectionDropdown.innerHTML = "<option value=''>Select a section</option>";

        const selectedDepartment = departmentDropdown.value;
        if (selectedDepartment !== "") {
            fetchUnits(selectedDepartment);
        }
    });

    // Function to fetch units based on the selected department (similar logic for section)
    function fetchUnits(departmentID) {
        const units = [
            { id: 1, name: "Unit X" },
            { id: 2, name: "Unit Y" },
            { id: 3, name: "Unit Z" }
        ];

        unitDropdown.innerHTML = "<option value=''>Select a unit</option>";
        units.forEach(function (unit) {
            unitDropdown.innerHTML += `<option value='${unit.id}'>${unit.name}</option>`;
        });
    }
});
