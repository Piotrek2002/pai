import React, { useState } from "react";
import Filter from "./Filter";
import ToDoList from "./ToDoList";
import NewTask from "./NewTask";

const App = () => {
    const [tasks, setTasks] = useState([]);
    const [showCompleted, setShowCompleted] = useState(true);

    const addTask = (task) => {
        setTasks([...tasks, { id: Date.now(), text: task, completed: false }]);
    };

    const toggleTask = (id) => {
        setTasks(tasks.map(task =>
            task.id === id ? { ...task, completed: !task.completed } : task
        ));
    };

    const filteredTasks = showCompleted
        ? tasks
        : tasks.filter(task => !task.completed);

    return (
        <div>
            <Filter showCompleted={showCompleted} setShowCompleted={setShowCompleted} />
            <NewTask addTask={addTask} />
            <ToDoList tasks={filteredTasks} toggleTask={toggleTask} />
        </div>
    );
};

export default App;
