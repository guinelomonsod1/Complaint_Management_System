import supabase from './lib/supabase';
import { useEffect } from 'react';


function App() {
  useEffect(() => {
    async function checkSession() {
      const { data, error } = await supabase.auth.getSession();

      if (error) {
        console.error('Session error:', error.message);
        return;
      }

      console.log('Supabase user:', {
        id: data.session?.user?.id,
        email: data.session?.user?.email,
        provider: data.session?.user?.app_metadata?.provider,
      });
    }

    checkSession();
  }, []);
  async function signInWithGoogle() {
    const { error } = await supabase.auth.signInWithOAuth({
      provider: 'google',
      options: {
        redirectTo: window.location.origin,
      },
    });
    if (error) {
      console.error('Error signing in with Google:', error.message);
    }
  }
  return (
    <button onClick={signInWithGoogle}>
      Continue with Google
    </button>
  );

}

export default App;