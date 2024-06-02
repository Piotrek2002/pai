import React from "react";
import Task from "./Task";

const ToDoList = ({ tasks, toggleTask }) => {
    if (tasks.length === 0) {
        return <p>No tasks to show</p>;
    }

    return (
        <ul>
            {tasks.map(task => (
                <Task key={task.id} task={task} toggleTask={toggleTask} />
            ))}
        </ul>
    );
};

export default ToDoList;
