import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import Header from '../../components/Header'
import Task from '../../components/Task'
import InsertList from '../../components/InsertList'
import InsertTask from '../../components/InsertTask'
import { Container, Grid  } from '@material-ui/core';
import api from '../../services/api';
import './styles.css';

export default function Lists() {
  const [token] = useState(localStorage.getItem('token'));
  const [taskList, setTaskList] = useState([]);
  const [listId,setListId] = useState('');

  const history = useNavigate();

  useEffect(() => {
    api.get('api/v1/taskslist/1', {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      if(response.data.status && response.data.status === (401 || 498)){
        localStorage.clear();
        history('/');
      }else{
        // console.log(response.data.data.title);
        setTaskList(response.data.data);
      }
    }).catch(err => {
      alert(err)
    })
  }, [token]);

  async function onInsertList(data){
    api.post("/api/v1/taskslist/create", data, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      if(response.data.status && response.data.status === (401 || 498)){
        localStorage.clear();
        history('/');
      }
      setTaskList([...taskList, response.data.data]);
    }).catch(err => {
      alert(err)
    })
  }

  async function onInsertTask(data){
    await setListId('')
    await api.post("/api/v1/list/tasks/1", data, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      console.log(response)
      if(response.data.status && response.data.status === (401 || 498)){
        localStorage.clear();
        history('/');
      }
      setListId(response.data.data.list_id)
    }).catch(err => {
      alert(err)
    })
    
  }
  
  return (
    <React.Fragment>
      <Header />

      <Container maxWidth="xl">
        <Grid container>
          <Grid item xs={3}>
            <InsertList onInsertList={onInsertList} />
            <InsertTask onInsertTask={onInsertTask} taskList={taskList} />
          </Grid>
          
          <Grid item xs={8}>
            <Container maxWidth="xl">
              <Grid container>
                {taskList.length > 0 ? taskList.map((list) => 
                  ( 
                    <Grid item xs={4} key={list.id}>
                      <div className="ListContainer">
                        <div className="ListHeader">
                          {list.status === "À Fazer" ? (
                            <h3 className="ListTitle">{list.title}</h3>
                          ) : (
                            <h3 className="ListTitle">{list.title} - Finalizado</h3>
                          )}
                          
                        </div>
                        <div className="Taks">
                          <div className="TaskItem">
                            <Container maxWidth="xl">
                              <Task list={list.id} listId={listId} />
                            </Container>
                          </div>
                        </div>
                      </div>
                    </Grid>
                  )) : null 
                }
              </Grid>
            </Container>
          </Grid>
        </Grid>
      </Container>
    </React.Fragment>
  );
}