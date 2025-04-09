import React, { useEffect, useState } from 'react';
import axios from 'axios';
import './App.css';

function App() {
  const [tasks, setTasks] = useState([]);

  useEffect(() => {
    fetchTasks();
  }, []);

  const fetchTasks = async () => {
    const response = await axios.get('http://localhost:8000/api/tasks');
    setTasks(response.data);
  };

  return (
    <div className="App">
      <header className="App-header">
        <h1>Task Tracker</h1>
        <ul>
          {tasks.map(task => (
            <li key={task.id}>
              <h2>{task.title}</h2>
              <p>{task.description}</p>
              <p>Исполнитель: {task.executor}</p>
              <p>Оценка по часам: {task.estimated_hours}</p>
              <p>Ревьюер: {task.reviewer}</p>
              <p>Состояние: {task.status}</p>
            </li>
          ))}
        </ul>
      </header>
    </div>
  );
}

export default App;
