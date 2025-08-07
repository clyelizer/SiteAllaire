import api from './api';
import AsyncStorage from '@react-native-async-storage/async-storage';

export const login = async (username, password) => {
  const response = await api.post('/auth/login', { username, password });
  const { token, user } = response.data;
  await AsyncStorage.setItem('token', token);
  return { token, user };
};

export const register = async (username, password, role, class_id) => {
  const response = await api.post('/auth/register', {
    username,
    password,
    role,
    class_id,
  });
  return response.data;
};

export const logout = async () => {
  await AsyncStorage.removeItem('token');
};
