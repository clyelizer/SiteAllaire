import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const GradeEntryScreen = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Grade Entry</Text>
    </View>
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

export default GradeEntryScreen;
