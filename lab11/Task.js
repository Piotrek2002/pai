import React from "react";

const Task = ({ task, toggleTask }) => {
  return (
    <li>
      <label>
        <input
          type="checkbox"
          checked={task.completed}
          onChange={() => toggleTask(task.id)}
        />
        {task.text}
      </label>
    </li>
  );
};

export default Task;
