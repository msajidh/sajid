package com.mywork.MADClass2021;

import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.media.AudioManager;
import android.media.MediaPlayer;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;
import androidx.appcompat.app.AppCompatActivity;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import java.io.IOException;

public class JukeBoxActivity extends AppCompatActivity {

    private TextView tv_status, url_id, title_id, artist_id;
    private ImageButton btn_play, btn_pause, btn_request;
    private MediaPlayer mediaPlayer;
    private String getUrl;
    private String key;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_juke_box);
        key = getIntent().getExtras().getString("key");
        btn_request = findViewById(R.id.btn_request);
        btn_play = findViewById(R.id.btn_play);
        btn_pause = findViewById(R.id.btn_pause);
        tv_status = findViewById(R.id.tv_status);
        url_id = findViewById(R.id.url_id);
        title_id = findViewById(R.id.title_id);
        artist_id = findViewById(R.id.artist_id);
        btn_play.setEnabled(false);
        btn_pause.setEnabled(false);
        btn_request.setEnabled(true);

        btn_play.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                playMusic();
            }
        });

        btn_pause.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mediaPlayer.pause();
                btn_pause.setBackgroundColor(Color.parseColor("#919191"));
                btn_play.setBackgroundColor(Color.parseColor("#FF2196F3"));
                btn_request.setBackgroundColor(Color.parseColor("#8BC34A"));
                btn_play.setEnabled(true);
                btn_pause.setEnabled(false);
                tv_status.setEnabled(true);
                tv_status.setText("Stopped");
            }
        });
        btn_request.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                CTower();
            }
        });
    }

    private void CTower() {
        btn_pause.setBackgroundColor(Color.parseColor("#919191"));
        btn_play.setBackgroundColor(Color.parseColor("#919191"));
        btn_request.setBackgroundColor(Color.parseColor("#919191"));
        btn_play.setEnabled(false);
        btn_pause.setEnabled(false);
        tv_status.setEnabled(false);
        tv_status.setText("Requesting song from CTower... ");
        tv_status.setTextColor(Color.parseColor("#919191"));
        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        String url = "http://mad.mywork.gr/get_song.php?t=" + getPref("key");
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        if (getTagValue(response, "status").toLowerCase()
                                .contains("ok")) {
                            getUrl=getTagValue(response,"url");
                            title_id.setText(getTagValue(response,"title"));
                            artist_id.setText(getTagValue(response,"artist"));
                            url_id.setText(getUrl);
                            btn_pause.setBackgroundColor(Color.parseColor("#919191"));
                            btn_play.setBackgroundColor(Color.parseColor("#FF2196F3"));
                            btn_request.setBackgroundColor(Color.parseColor("#8BC34A"));
                            btn_play.setEnabled(true);
                            btn_pause.setEnabled(false);
                            tv_status.setEnabled(true);
                            tv_status.setText("Stopped");
                            playMusic();

                        } else {
                            Log.e("res", response);
                            Intent i = new Intent(JukeBoxActivity.this, LoginActivity.class);
                            startActivity(i);
                        }

                        Log.e("Res", response);
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

                Log.e("res", error.getMessage());
            }
        });

        queue.add(stringRequest);
    }

    private void playMusic() {

        mediaPlayer = new MediaPlayer();
        mediaPlayer.setAudioStreamType(AudioManager.STREAM_MUSIC);

        try {
            mediaPlayer.setDataSource(getUrl);
            mediaPlayer.prepare();
            mediaPlayer.start();
            btn_pause.setBackgroundColor(Color.parseColor("#FFDA1414"));
            btn_play.setBackgroundColor(Color.parseColor("#919191"));
            btn_request.setBackgroundColor(Color.parseColor("#8BC34A"));
            btn_play.setEnabled(false);
            tv_status.setEnabled(false);
            btn_pause.setEnabled(true);
            tv_status.setText("Playing");

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public String getTagValue(String xmlText, String tagName) {

        String[] firstParts = xmlText.split("<" + tagName + ">");
        String[] secondParts = firstParts[1].split("</" + tagName + ">");
        System.out.println(firstParts);
        System.out.println(secondParts);
        return secondParts[0];
    }

    public  String getPref(String key) {
        SharedPreferences preferences = PreferenceManager.getDefaultSharedPreferences(this);
        return preferences.getString(key, null);
    }
}

