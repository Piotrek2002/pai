import React, { useState } from "react";

const NewTask = ({ addTask }) => {
    const [task, setTask] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
        if (task.trim()) {
            addTask(task);
            setTask("");
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <input
                type="text"
                value={task}
                onChange={(e) => setTask(e.target.value)}
                placeholder="New task"
            />
            <button type="submit">Add</button>
        </form>
    );
};

export default NewTask;
