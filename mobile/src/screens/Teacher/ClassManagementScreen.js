import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const ClassManagementScreen = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Class Management</Text>
    </V>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  title: {
    fontSize: 24,
  },
});

export default ClassManagementScreen;
