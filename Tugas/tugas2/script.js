const taskinput = document.getElementById("taskinput");
const tasklist = document.getElementById("tasklist");
const tasks = JSON.parse(localStorage.getItem("tasks")) || [];

// Fungsi untuk menambahkan task
function addTask() {
  const taskText = taskinput.value.trim();
  if (taskText === "") return;
  
  const task = {Text: taskText};
  tasks.push(task);
  localStorage.setItem("tasks", JSON.stringify(tasks));
  taskinput.value = "";
  displayTasks();
}

// Fungsi untuk menghapus task
function deleteTask(index) {
  tasks.splice(index, 1);
  localStorage.setItem("tasks", JSON.stringify(tasks));
  displayTasks();
}

// Fungsi untuk mengedit task
function editTask(index) {
  const newTaskText = prompt("Edit Task:", tasks[index].Text);
  if (newTaskText !== null && newTaskText.trim() !== "") {
    tasks[index].Text = newTaskText.trim();
    localStorage.setItem("tasks", JSON.stringify(tasks));
    displayTasks();
  }
}

// Fungsi untuk menampilkan task
function displayTasks() {
  tasklist.innerHTML = "";
  
  tasks.forEach((task, index) => {
    const li = document.createElement("li");
    li.innerHTML = `
      <span>${task.Text}</span>
      <div>
        <button class="edit-button" onclick="editTask(${index})">Edit</button> 
        <button class="delete-button" onclick="deleteTask(${index})">Delete</button>
      </div>
    `;
    tasklist.appendChild(li);
  });
}

// Tampilkan task saat pertama kali halaman dimuat
displayTasks();
