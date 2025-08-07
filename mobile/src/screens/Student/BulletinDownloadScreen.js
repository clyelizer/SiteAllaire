import React from 'react';
import { View, Text, Button, StyleSheet } from 'react-native';
import api from '../../services/api';
import * as FileSystem from 'expo-file-system';
import * as Sharing from 'expo-sharing';

const BulletinDownloadScreen = () => {
  const handleDownload = async () => {
    try {
      const response = await api.get('/bulletins/generate/1', {
        responseType: 'blob',
      });
      const fileReader = new FileReader();
      fileReader.readAsDataURL(response.data);
      fileReader.onload = async () => {
        const fileUri = FileSystem.documentDirectory + 'bulletin.pdf';
        await FileSystem.writeAsStringAsync(
          fileUri,
          fileReader.result.split(',')[1],
          { encoding: FileSystem.EncodingType.Base64 }
        );
        Sharing.shareAsync(fileUri);
      };
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Download Bulletin</Text>
      <Button title="Download" onPress={handleDownload} />
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

export default BulletinDownloadScreen;
