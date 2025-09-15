<div id="save-result" class="content-section mt-4">
    <h4>Save Student Result</h4>
    <form>
        <div class="mb-3">
            <label class="form-label">Student Roll</label>
            <input type="text" class="form-control" placeholder="Enter Student Roll">
        </div>
        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" class="form-control" placeholder="Enter Student Name">
        </div>
        <div class="mb-3">
            <label class="form-label">Course</label>
            <select class="form-select">
                <option>Select Course</option>
                <option value="1">Introduction to Programming</option>
                <option value="2">Database Systems</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Marks</label>
            <input type="number"
                   class="form-control"
                   placeholder="Enter Marks"
                   min="0"
                   max="100"
                   oninput="generateGrade(this.value)">
        </div>
        <div class="mb-3">
            <label class="form-label">Grade</label>
            <input type="text" class="form-control" id="grade" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Save Result</button>
    </form>
</div>
