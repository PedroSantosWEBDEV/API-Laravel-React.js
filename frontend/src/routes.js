import React from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';

import Logon from './pages/Logon';
import Register from './pages/Register';
import Lists from './pages/Lists';

export default function Rotas() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" exact element={<Logon/>} />
        <Route path="/register" element={<Register/>} />
        <Route path="/lists" element={<Lists/>} />
      </Routes>
    </BrowserRouter>
  );
}