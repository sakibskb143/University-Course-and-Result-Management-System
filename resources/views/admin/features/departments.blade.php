 <div id="departments" class="content-section">
     <h4>Department Management</h4>

     <!-- Button to open modal -->
     <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
         Add Department
     </button>

     <table class="table table-bordered">
         <thead>
             <tr>
                 <th>Code</th>
                 <th>Name</th>
             </tr>
         </thead>
         <tbody>
             <tr>
                 <td>CSE</td>
                 <td>Computer Science & Engineering</td>
             </tr>
         </tbody>
     </table>
 </div>

 <!-- Bootstrap Modal -->
 <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <h5 class="modal-title" id="addDepartmentModalLabel">Add Department</h5>
                 <button type="button" class="btn-close primary-color" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>

             <!-- Modal Body (Form) -->
             <div class="modal-body">
                 {{-- action="{{ route('departments.store') }}" method="POST" --}}
                 <form>
                     @csrf
                     <div class="mb-3">
                         <label for="department_code" class="form-label">Department Code</label>
                         <input type="text" class="form-control" id="department_code" name="department_code"
                             placeholder="e.g., CSE" required>
                     </div>
                     <div class="mb-3">
                         <label for="department_name" class="form-label">Department Name</label>
                         <input type="text" class="form-control" id="department_name" name="department_name"
                             placeholder="e.g., Computer Science & Engineering" required>
                     </div>

                     <!-- Modal Footer -->
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Add Department</button>
                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>
