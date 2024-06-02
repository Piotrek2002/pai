import React from "react";

const Filter = ({ showCompleted, setShowCompleted }) => {
    return (
        <div>
            <label>
                <input
                    type="checkbox"
                    checked={showCompleted}
                    onChange={(e) => setShowCompleted(e.target.checked)}
                />
                Show completed tasks
            </label>
        </div>
    );
};

export default Filter;
